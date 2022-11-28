@extends('layouts.master')
@section('content')
    <div class="container mt-3">
        <h2>NBP</h2>
        <p>Aktualne kursy walut strona A</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Waluta</th>
                    <th>Kod</th>
                    <th>Kurs</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($response) --}}
                @foreach ($response as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->currency_code }}</td>
                        <td>1 PLN = {{ $item->exchange_rate . ' ' . $item->currency_code }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
