@extends('layouts.admin')

@section('title', 'Users — Kraite Console')

@section('header-left')
    <x-breadcrumb
        :list="[['text' => 'Entities'], config('menu.entities.users')]"
        home-path="/dashboard"
    />
@endsection

@section('content')
    <x-container>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-card>
                    <x-card.header>
                        <x-card.title>
                            <x-icon name="UserMultiple" color="primary" size="text-3xl" />
                            <div>
                                <div>Users</div>
                                <x-card.subtitle>Operator + customer accounts</x-card.subtitle>
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
