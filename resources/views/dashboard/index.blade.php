@extends('layouts.admin')

@section('title', 'Dashboard — Kraite Console')

@section('header-left')
    <x-breadcrumb :list="[['text' => 'Dashboard', 'icon' => 'Home09']]" home-path="/dashboard" />
@endsection

@section('content')
    <x-container>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-card>
                    <x-card.header>
                        <x-card.title>
                            <x-icon name="DashboardSquare03" color="primary" size="text-3xl" />
                            <div>
                                <div>Dashboard</div>
                                <x-card.subtitle>Operator overview</x-card.subtitle>
                            </div>
                        </x-card.title>
                    </x-card.header>
                    <x-card.body class="overflow-hidden">
                        <x-empty />
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </x-container>
@endsection
