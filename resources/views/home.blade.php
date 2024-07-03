@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>

        <h1>Mostrando</h1>
    </x-listar-post> --}}

    <x-listar-post :posts="$posts" />

    {{-- @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        <p>No hay publicaciones</p>
    @endforelse --}}
@endsection
