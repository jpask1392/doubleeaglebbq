@php 
// Layout
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");
$remove_image_crop = get_sub_field("remove_image_crop");

$rip_options = get_sub_field('section_rips');

$asymetric = get_sub_field('asymetric_layout');
$priority = get_sub_field('priority');
$col_left;
$col_right;
if ($asymetric == true & $priority == 'left') { 
    $col_left = "col-md-7";
    $col_right = "col-md-5";
} else {
    $col_left = "col-md-5";
    $col_right = "col-md-7";
}

$col_1_content;
$col_2_content;
$col_1_content_type;
$col_2_content_type;

switch (get_sub_field('layout_options')) {

  case 'text_image':
    $col_1_content = get_sub_field('text_lhs');
    $col_1_content_type = ' text animate-down';
    $col_2_content_type = $remove_image_crop ? ' image animate-up' : ' image image-crop animate-up';
    $col_2_content = $remove_image_crop ? '<img class="w-100" src="' . get_sub_field('image_rhs')['url'] .'" alt="">' : '<div class="crop-aspect"><div class="crop" style="background-image:url(' . get_sub_field('image_rhs')['url'] . ')"></div></div>';
    break;
    
  case 'image_text':
    $col_1_content_type = $remove_image_crop ? ' image animate-up' : ' image image-crop animate-up';
    $col_2_content_type = ' text animate-down';
    $col_1_content = $remove_image_crop ? '<img class="w-100" src="' . get_sub_field('image_lhs')['url'] .'" alt="">' : '<div class="crop-aspect"><div class="crop" style="background-image:url(' . get_sub_field('image_lhs')['url'] . ')"></div></div>';
    $col_2_content = get_sub_field('text_rhs');
    break;
}

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
  
@endphp


<section class="split-section {{ $bkg_color }} rip-bottom--2">

  @if ($include_section_header)
    <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
  @endif

  <div class="{{ $container_width }} px-md-5 py-3 py-md-5 align-items-center justify-content-{{ $justify_content }}">

    <div class="row align-items-{{ $vertical_content_align }}">
        
      <div class="{{ $asymetric ? $col_left : 'col-md-6' }}{{ $col_1_content_type }}">
        {!! $col_1_content !!}
      </div>

      <div class="{{ $asymetric ? $col_right : 'col-md-6' }}{{ $col_2_content_type }}">
        {!! $col_2_content !!}
      </div>
             
    </div>
  </div>

  @if (in_array('Rip Bottom', $rip_options)) 
    <div class="rip-bottom rip-bottom--2">
      <div class="rip"></div>
    </div>
  @endif
    
</section>
