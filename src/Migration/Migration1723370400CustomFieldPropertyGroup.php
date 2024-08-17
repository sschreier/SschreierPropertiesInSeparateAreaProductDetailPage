<?php
declare(strict_types=1);

namespace Sschreier\PropertiesInSeparateAreaProductDetailPage\Migration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\CustomField\CustomFieldTypes;

final class Migration1723370400CustomFieldPropertyGroup extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public const FIELDSET_NAME = 'sschreier_property_group';
    public const CUSTOMFIELD_NAME = 'sschreier_property_group_tooltip';

    public function getCreationTimestamp(): int
    {
        return 1723370400;
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function update(Connection $connection): void
    {
        $customFieldSetId = $this->createCustomFieldSet($connection, self::FIELDSET_NAME, '{"label": {"de-DE": "Zusätzliche Einstellungen", "en-GB": "additional settings"}}');

        $this->createCustomField($connection, $customFieldSetId, self::CUSTOMFIELD_NAME, CustomFieldTypes::HTML, '{"label": {"de-DE": "Beschreibung", "en-GB": "description"}, "componentName": "sw-text-editor", "customFieldType": "textEditor", "customFieldPosition": 1}');

        $this->createCustomFieldRelation($connection, $customFieldSetId);
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    protected function createCustomFieldSet(Connection $connection, string $name, string $config): string
    {
        $customFieldSetId = Uuid::randomBytes();

        $customFieldSetStmt = $connection->prepare(self::getCustomFieldSetSql());
        $customFieldSetStmt->executeStatement([
            'id' => $customFieldSetId,
            'name' => $name,
            'config' => $config,
            'position' => 1,
            'created_at' => self::getDateTimeValue(),
        ]);

        return $customFieldSetId;
    }

    protected function createCustomField(Connection $connection, string $customFieldSetId, string $name, string $fieldType, string $config): string
    {
        $customFieldId = Uuid::randomBytes();

        $customFieldStmt = $connection->prepare(self::getCustomFieldSql());
        $customFieldStmt->executeStatement(
            [
                'id' => $customFieldId,
                'name' => $name,
                'fieldType' => $fieldType,
                'config' => $config,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );

        return $customFieldId;
    }

    protected function createCustomFieldRelation(Connection $connection, $customFieldSetId): void
    {
        $customFieldRelationId = Uuid::randomBytes();

        $customFieldRelationStmt = $connection->prepare(self::getCustomFieldRelationSql());
        $customFieldRelationStmt->executeStatement(
            [
                'id' => $customFieldRelationId,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
                'entity_name' => 'property_group'
            ],
        );
    }

    protected static function getCustomFieldSetSql(): string
    {
        return <<<'SQL'
            INSERT INTO `custom_field_set` (`id`, `name`, `config`, `active`, `app_id`, `position`, `global`, `created_at`, `updated_at`) VALUES
            (:id, :name, :config, 1, NULL, :position, 0, :created_at, NULL);
            SQL;
    }

    public static function getCustomFieldSql(): string
    {
        return <<<'SQL'
                INSERT INTO `custom_field` (`id`, `name`, `type`, `config`, `active`, `set_id`, `created_at`, `updated_at`, `allow_customer_write`) VALUES
                (:id, :name, :fieldType, :config, 1, :set_id, :created_at, NULL, 1);
            SQL;
    }

    public static function getCustomFieldRelationSql(): string
    {
        return <<<'SQL'
                INSERT INTO `custom_field_set_relation` (`id`, `set_id`, `entity_name`, `created_at`, `updated_at`) VALUES
                (:id, :set_id, :entity_name, :created_at, NULL);
            SQL;
    }

    protected static function getDateTimeValue(): string
    {
        return (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT);
    }
}
