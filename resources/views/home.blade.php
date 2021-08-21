@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <h6 class="card-title">Bem vindo a {{ $a }}</h6>
    @if($precadastro >= 1)
    <div class="card card-accent-success mb-12" style="max-width: 18rem;">
      <div class="card-body text-success">
        <h6 class="card-title">Há cadastros a serem aprovados</h6>
        <a href="{{ route('people.index') }}" class="btn btn-primary">Pré-cadastro</a>
        </p>
      </div>
    </div>
    @endif
    <style type="text/css">
      .btn {
        margin-bottom: 4px;
      }
    </style>
    <div class="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h6>Rede Sociais</h6>
              <p>
                @if($social->facebook_link !== null)
                <button class="btn btn-sm btn-facebook" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-facebook-f"></use>
                  </svg><span>Facebook</span>
                </button>
                @endif
                @if($social->twitter_link !== null)
                <button class="btn btn-sm btn-twitter" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-twitter"></use>
                  </svg><span>Twitter</span>
                </button>
                @endif
                @if($social->linkedin_link !== null)
                <button class="btn btn-sm btn-linkedin" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-linkedin"></use>
                  </svg><span>LinkedIn</span>
                </button>
                @endif
                @if($social->youtube_link !== null)
                <button class="btn btn-sm btn-youtube" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-youtube"></use>
                  </svg><span>YouTube</span>
                </button>
                @endif
                @if($social->instagram_link !== null)
                <button class="btn btn-sm btn-instagram" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-instagram"></use>
                  </svg><span>Instagram</span>
                </button> 
                @endif
                @if($social->vk_link !== null)
                <button class="btn btn-sm btn-vk" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-vk"></use>
                  </svg><span>VK</span>
                </button>
                @endif
                @if($social->site_link !== null)
                <button class="btn btn-sm btn-yahoo" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt"></use>
                  </svg><span>Website</span>
                </button>
                @endif
                @if($social->telegram_link !== null)
                <button class="btn btn-sm btn-yahoo" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-telegram"></use>
                  </svg><span>Telegram</span>
                </button>
                @endif
                @if($social->whatsapp_link !== null)
                <button class="btn btn-sm btn-vimeo" type="button">
                  <svg class="c-icon mr-2">
                    <use xlink:href="/icons/sprites/brand.svg#cib-whatsapp"></use>
                  </svg><span>Whatsapp</span>
                </button>
                @endif
              </p>
            </div>
          </div>
        </div>

        </div>        
        @endsection
        @section('javascript')
          
@endsection