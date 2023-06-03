@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/cards.singular')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('cards.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('cards.show_fields')
                </div>
                <!-- The approve button -->
                @if(!$card->paid)
                <button id="approve-button" class="btn btn-primary">Approve</button>
                @endif
                <!-- The expiration form (initially hidden) -->

                <form class="form-group " id="expiration-form" action="{{ route('paid') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value={{ $card->id }}>
                    <label for="expiration">Expiration:</label>
                    <select id="expiration" name="expiration" class="form-control">
                        <option value="6m">6 months</option>
                        <option value="1y">1 year</option>
                        <option value="2y">2 years</option>
                    </select>
                    <input type="submit" class="btn btn-primary my-3" value="Submit">
                </form>
                @push('paidscript')
                    <script>
                        // Show the expiration form when the approve button is clicked
                        $('#approve-button').on('click', function() {
                            $('#expiration-form').show();
                            $('#approve-button').hide();
                        });
                    </script>
                @endpush

            </div>
        </div>
    </div>
@endsection
