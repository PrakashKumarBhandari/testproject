<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php

$street = $row->_field_data['nid']['entity']->location['street'];
$additional = $row->_field_data['nid']['entity']->location['additional'];
$city = $row->_field_data['nid']['entity']->location['city'];
$province = $row->_field_data['nid']['entity']->location['province'];
$zip = $row->_field_data['nid']['entity']->location['postal_code'];

if( !empty($street) ) {
  $address = '<span itemprop="streetAddress">'.$street.'</span>';
  if( !empty($additional) ) {
    $address = '<span itemprop="streetAddress">'.$street.', </span>';
    $address .= '<span class="additional" itemprop="streetAddress">'.$additional.'</span>';
  }
}

$output = '<div class="location vcard" itemscope="" itemtype="http://schema.org/PostalAddress"><div class="adr">';
$output .= '<div class="street-address">';
$output .= $address;
$output .= '</div>';
$output .= '<span class="locality" itemprop="addressLocality">'.$city.', </span>';
$output .= '<span class="region" itemprop="addressRegion">'.$province.' </span>';
$output .= '<span class="postal-code" itemprop="postalCode">'.$zip.'</span>';
$output .= '</div></div>';

print $output; 

?>