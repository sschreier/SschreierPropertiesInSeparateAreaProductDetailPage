# An extension to show the properties in a separate area on the product detail page for Shopware 6

An extension to _show the properties in a separate area on_ the _product detail page_. The _separate area can_ either _be a separate tab_ or _a modal box that can be reached via a link_. The _tab can be shown before or after the rating tab_. The _link to open_ the _modal can be placed either above the buy button_, _above the product number_ or _below the description text in the description tab_. Furthermore, you can _show a headline and a text above the property table_ if required. In addition, _tooltips can also be shown to describe the properties_.

## Possible configurations 
- select the area on the product detail page where the properties should be shown
- set the title of the modal or the title of the label of the tab via snippet
- select if a headline above the property table should be shown
- set the headline above the property table via snippet
- select if a text above the property table should be shown
- set the text above the property table via snippet
- select if the property table should be shown in larger resolutions in full width

## Possible configurations for the tab
- select if properties tab should be shown before the rating tab
- set the preview text of the tab in the smaller resolutions via snippet

## Possible configurations for the modal
- select the position of the link to open the modal
- set the text of the link to open the modal via snippet
- select if an icon should be shown before the link to open the modal above the product number
- select if the modal title should be shown
- select the size of the modal

## Available snippets
- sschreier.propertiesinseparateareaproductdetailpage.headline
- sschreier.propertiesinseparateareaproductdetailpage.modal.linkToOpenModal
- sschreier.propertiesinseparateareaproductdetailpage.tab.previewMore
- sschreier.propertiesinseparateareaproductdetailpage.text
- sschreier.propertiesinseparateareaproductdetailpage.title

## How to install the extension
### via console (recommended)
1. Download the latest _SschreierPropertiesInSeparateAreaProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierPropertiesInSeparateAreaProductDetailPage_. 
3. Move the folder to the project folder _custom/plugins/_ .
4. Connect to the console via ssh:

```
bin/console plugin:refresh
bin/console plugin:install --activate SschreierPropertiesInSeparateAreaProductDetailPage
```

### via composer
1. Add the repository URL to the composer.json of the project
```
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/sschreier/SschreierPropertiesInSeparateAreaProductDetailPage"
    }
],
```

2. Connect to the console via ssh and install the plugin source code via the command
```
composer require sschreier/sschreierpropertiesinseparateareaproductdetailpage
bin/console plugin:refresh
bin/console plugin:install --activate SschreierPropertiesInSeparateAreaProductDetailPage
```

### via zip upload
1. Download the latest _SschreierPropertiesInSeparateAreaProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierPropertiesInSeparateAreaProductDetailPage_.
3. Zip the folder to _SschreierPropertiesInSeparateAreaProductDetailPage.zip_.
4. Upload the zip in the Shopware Administration.
5. Install & Activate the extension.

#### extension update (zip)
1. Download the latest _SschreierPropertiesInSeparateAreaProductDetailPage-master.zip_.
2. Unzip the zip file and rename the folder to _SschreierPropertiesInSeparateAreaProductDetailPage_.
3. Zip the folder to _SschreierPropertiesInSeparateAreaProductDetailPage.zip_.
4. Upload the zip in the Shopware Administration.
5. Update the extension.

## Images

### default: properties within the description tab

![default: properties within the description tab](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image1.jpg)

### properties in a separate tab

![properties in a separate tab](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image2.jpg)

### properties in a separate tab and with a custom headline and text

![properties in a separate tab and with a custom headline and text](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image3.jpg)

### properties in a modal that can be reached via a link that is located below the description text in the description tab

![properties in a modal that can be reached via a link that is located below the description text in the description tab](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image4.jpg)

### properties in a modal

![properties in a modal](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image5.jpg)

### properties in a modal that can be reached via a link that is located above the buy button

![properties in a modal that can be reached via a link that is located above the buy button](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image6.jpg)

### properties in a modal that can be reached via a link that is located above the product number

![properties in a modal that can be reached via a link that is located above the product number](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image7.jpg)

### properties within the description tab with a tooltip icon

![properties within the description tab with a tooltip icon](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image8.jpg)

### properties within the description tab with an open tooltip

![properties within the description tab with an open tooltip](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image9.jpg)

### extension configuration part 1

![extension configuration part 1](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image10.jpg)

### extension configuration part 2

![extension configuration part 2](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image11.jpg)

### extension configuration part 3

![extension configuration part 3](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image12.jpg)

### custom description for a property displayed in a tooltip and set within the custom fields of a property

![custom description for a property displayed in a tooltip and set within the custom fields of a property](https://www.sebastianschreier.de/plugins/SschreierPropertiesInSeparateAreaProductDetailPage/SschreierPropertiesInSeparateAreaProductDetailPage-Image13.jpg)
