@extends('Admin::layouts.sortable')
@section('title', __('Edit Menu'))
@section('card-title', __('Menus List'))
@section('base-url', route('admin.menus.index'))
@section('card-body')
    @form([\ToiLaDev\Menu\Forms\MenuForm::class, 'edit'], [$menu, $menus])
@endsection