@extends('layouts.app')

@section('content')
  @include('partials.page-header')
    @while (have_rows('recipe_template')) @php the_row() @endphp

      @if (get_row_layout() == "standard_layout") 
        @include('sections.section-standard')
      @endif

      @if (get_row_layout() == "in_action_layout") 
        @include('recipe-sections.section-in-action')
      @endif

      @if (get_row_layout() == "ingredients_layout") 
        @include('recipe-sections.section-ingredients')
      @endif

      @if (get_row_layout() == "cooking_instructions_layout") 
        @include('recipe-sections.section-cooking-instructions')
      @endif

    @endwhile
@endsection
