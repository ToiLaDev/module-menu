@extends('Admin::layouts.sortable')
@section('title', __('Menus'))
@section('card-title', __('Menus List'))
@section('base-url', route('admin.menus.index'))
@section('card-body')
    @form([\ToiLaDev\Menu\Forms\MenuForm::class, 'create'], $menus)
@endsection