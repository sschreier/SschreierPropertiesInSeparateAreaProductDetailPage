<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@web-solutions-dresden.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\PropertiesInSeparateAreaProductDetailPage\Migration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\CustomField\CustomFieldTypes;

final class Migration1723370400CustomFieldPropertyGroup extends MigrationStep
{
    public const FIELDSET_NAME = 'sschreier_property_group';
    public const CUSTOMFIELD_NAME = 'sschreier_property_group_tooltip';

    private const FIELDSET_CONFIG = <<<'JSON'
        {"label":{"de-DE":"Zusätzliche Einstellungen","en-GB":"additional settings"},"translated":true}
        JSON;

    private const CUSTOMFIELD_CONFIG = <<<'JSON'
        {"label":{"de-DE":"Beschreibung","en-GB":"description"},"componentName":"sw-text-editor","customFieldType":"textEditor","customFieldPosition":1}
        JSON;

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
        $customFieldSetId = $this->getOrCreateCustomFieldSet($connection, self::FIELDSET_NAME, self::FIELDSET_CONFIG);

        $this->createCustomFieldIfMissing(
            $connection,
            $customFieldSetId,
            self::CUSTOMFIELD_NAME,
            CustomFieldTypes::HTML,
            self::CUSTOMFIELD_CONFIG
        );

        $this->createCustomFieldRelationIfMissing($connection, $customFieldSetId);
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    private function getOrCreateCustomFieldSet(Connection $connection, string $name, string $config): string
    {
        $existingId = $connection->fetchOne(
            'SELECT `id` FROM `custom_field_set` WHERE `name` = :name',
            ['name' => $name]
        );

        if (is_string($existingId)) {
            return $existingId;
        }

        $customFieldSetId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldSetSql(),
            [
                'id' => $customFieldSetId,
                'name' => $name,
                'config' => $config,
                'position' => 1,
                'created_at' => self::getDateTimeValue(),
            ]
        );

        return $customFieldSetId;
    }

    private function createCustomFieldIfMissing(
        Connection $connection,
        string $customFieldSetId,
        string $name,
        string $fieldType,
        string $config
    ): void {
        $existingId = $connection->fetchOne(
            'SELECT `id` FROM `custom_field` WHERE `set_id` = :set_id AND `name` = :name',
            [
                'set_id' => $customFieldSetId,
                'name' => $name,
            ]
        );

        if (is_string($existingId)) {
            return;
        }

        $customFieldId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldSql(),
            [
                'id' => $customFieldId,
                'name' => $name,
                'fieldType' => $fieldType,
                'config' => $config,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );
    }

    private function createCustomFieldRelationIfMissing(Connection $connection, string $customFieldSetId): void
    {
        $existingId = $connection->fetchOne(
            'SELECT `id` FROM `custom_field_set_relation` WHERE `set_id` = :set_id AND `entity_name` = :entity_name',
            [
                'set_id' => $customFieldSetId,
                'entity_name' => 'property_group',
            ]
        );

        if (is_string($existingId)) {
            return;
        }

        $customFieldRelationId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldRelationSql(),
            [
                'id' => $customFieldRelationId,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
                'entity_name' => 'property_group',
            ],
        );
    }

    private static function getCustomFieldSetSql(): string
    {
        return <<<SQL
            INSERT INTO `custom_field_set` (`id`, `name`, `config`, `active`, `app_id`, `position`, `global`, `created_at`, `updated_at`) VALUES
            (:id, :name, :config, 1, NULL, :position, 0, :created_at, NULL);
            SQL;
    }

    private static function getCustomFieldSql(): string
    {
        return <<<SQL
            INSERT INTO `custom_field` (`id`, `name`, `type`, `config`, `active`, `set_id`, `created_at`, `updated_at`, `allow_customer_write`) VALUES
            (:id, :name, :fieldType, :config, 1, :set_id, :created_at, NULL, 0);
            SQL;
    }

    private static function getCustomFieldRelationSql(): string
    {
        return <<<SQL
            INSERT INTO `custom_field_set_relation` (`id`, `set_id`, `entity_name`, `created_at`, `updated_at`) VALUES
            (:id, :set_id, :entity_name, :created_at, NULL);
            SQL;
    }

    protected static function getDateTimeValue(): string
    {
        return (new \DateTimeImmutable())->format(Defaults::STORAGE_DATE_TIME_FORMAT);
    }
}
