<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 * 
 * Returns HTML for a field.
 *
 * This is the default theme implementation to display the value of a field. 
 * Theme developers who are comfortable with overriding theme functions may do so in order to customize this markup. 
 * This function can be overridden with varying levels of specificity. For example, for a field named 'body' displayed on 
 * the 'article' content type, any of the following functions will override this default implementation. The first of 
 * these functions that exists is used:
 * 
 * THEMENAME_field__body__article()
 * THEMENAME_field__article()
 * THEMENAME_field__body()
 * THEMENAME_field()
 * Theme developers who prefer to customize templates instead of overriding functions may 
 * copy the "field.tpl.php" from the "modules/field/theme" folder of the Drupal installation 
 * to somewhere within the theme's folder and customize it, just like customizing other Drupal templates 
 * such as page.tpl.php or node.tpl.php. However, it takes longer for the server to process templates than to 
 * call a function, so for websites with many fields displayed on a page, this can result in a 
 * noticeable slowdown of the website. For these websites, developers are discouraged from placing 
 * a field.tpl.php file into the theme's folder, but may customize templates for specific fields. For example, 
 * for a field named 'body' displayed on the 'article' content type, any of the following templates will 
 * override this default implementation. The first of these templates that exists is used:
 * 
 * field--body--article.tpl.php
 * field--article.tpl.php
 * field--body.tpl.php
 * field.tpl.php
 * 
 * So, if the body field on the article content type needs customization, a field--body--article.tpl.php
 * file can be added within the theme's folder. Because it's a template, it will result in slightly more
 * time needed to display that field, but it will not impact other fields, and therefore, is unlikely to
 * cause a noticeable change in website performance. A very rough guideline is that if a page is being
 * displayed with more than 100 fields and they are all themed with a template instead of a function, 
 * it can add up to 5% to the time it takes to display that page. This is a guideline only and the exact
 * performance impact depends on the server configuration and the details of the website.
**/
?>
<?php 
	/*modify the label on this field depending on the node it is attached to*/
	$type_of_parent = $element['#object']->type;
	switch ($type_of_parent) {
		case 'page':
			$label = "Check out these projects";
			break;
		case 'default':
			break;
	}
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
    <?php endforeach; ?>
  </div>
</div>
