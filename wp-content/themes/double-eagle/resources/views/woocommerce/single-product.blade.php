@extends('layouts.app')

@section('content')
@include('partials.page-header')
  @while(have_posts()) @php the_post() @endphp
    {{ do_action( 'woocommerce_before_main_content' ) }}
    {{ wc_get_template_part( 'content', 'single-product' ) }}
    {{ do_action( 'woocommerce_after_main_content' ) }}
    {{ comments_template() }}
  @endwhile

@endsection
