@php 
// Layout
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");
$layout_option = get_sub_field('layout_options');

$rip_options = get_sub_field('section_rips');

$bkg_image = get_sub_field('background_image');
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = !get_sub_field('background_gradient_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');
  
@endphp

<section class="banner-section {{$layout_option == 'two_blocks' ? 'split-banner' : 'full-width'}}">

  @if (in_array('Rip Top', $rip_options)) 
    <div class="rip-top rip-top--1">
      <div class="rip"></div>
    </div>
  @endif

  @if ($include_section_header)
    <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
  @endif

  <div class="container-fluid">

    <div class="row">

      @if ($layout_option == 'two_blocks')
        
      <div class="block-content-wrapper col-md-6 p-5 d-flex" style="background-image: url('{{ get_sub_field('block_lhs')['background_image']['url'] }}')">
          <div  class="block-overlay" 
                style="background-color: {{get_sub_field('block_lhs')['background_overlay']}}; opacity: {{get_sub_field('block_lhs')['overlay_opacity']}};"></div>
 
        <div class="block-content align-self-center">
          {!! get_sub_field('block_lhs')['text'] !!}
        </div>
      </div>

      <div class="block-content-wrapper col-md-6 p-5 d-flex" style="background-image: url('{{ get_sub_field('block_rhs')['background_image']['url'] }}')">
        <div  class="block-overlay" 
              style="background-color: {{get_sub_field('block_rhs')['background_overlay']}}; opacity: {{get_sub_field('block_rhs')['overlay_opacity']}};"></div>
        <div class="block-content align-self-center">
          {!! get_sub_field('block_rhs')['text'] !!}
        </div>
      </div>

      @else 

      <div class="block-content-wrapper full-width w-100 ml-0" style="background-image: url('{{ get_sub_field('block_full')['background_image']['url'] }}')">
        <div  class="block-overlay" 
              style="background-color: {{get_sub_field('block_full')['background_overlay']}}; opacity: {{get_sub_field('block_full')['overlay_opacity']}};"></div>
        <div class="container py-5 block-content full-width-banner">
          {!! get_sub_field('block_full')['text'] !!}
        </div>
      </div>
      
      @endif
    </div>
  </div>

  @if (in_array('Rip Bottom', $rip_options)) 
    <div class="rip-bottom rip-bottom--3">
      <div class="rip"></div>
    </div>
  @endif
    
</section>