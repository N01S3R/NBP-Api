@extends('layouts.master')
@section('content')
    <div class="container mt-3">
        <h2>NBP</h2>
        <p>Aktualne kursy walut strona A</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Waluta</th>
                    <th>Kod</th>
                    <th>Kurs</th>
                </tr>
            </thead>
            <tbody>
              {{-- @dd($response['rates']) --}}
              @foreach ($response['rates'] as $items)
                <tr>
                    <td>{{ $items['currency'] }}</td>
                    <td>{{ $items['code'] }}</td>
                    <td>{{ $items['mid'] }}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection
