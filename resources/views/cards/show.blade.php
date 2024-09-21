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
            @if(!$card)
            <div class="alert alert-warning">
                You have not added a card yet. Please create one.
            </div>
            <a href="{{ route('cards.create') }}" class="btn btn-primary">Add Your Card</a>
            @else
            <div class="row">
                @include('cards.show_fields')
            </div>

            <!-- Approve button, only for admin/super admin | admin -->
            @role('admin|super admin')
            @if(!$card->paid || $card->expiration < Carbon\Carbon::now() && $card->expiration != null)
                <button id="approve-button" class="btn btn-primary">Approve</button>
                @endif
                <!-- Reject Button and Comment Box -->
                <button type="button" class="btn btn-danger" id="reject-button">Reject</button>

                <form action="{{ route('cards.reject', $card->id) }}" method="POST" id="reject-form" style="display:none;">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="comment">Reason for Rejection:</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Submit Rejection</button>
                </form>
        </div>



        @endrole

        <!-- Edit button, only for student -->
        @role('student')
        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-primary">Edit My Card</a>
        <p class="text-warning mt-3">*Note: Editing certain sensitive information will return your card to the request state.</p>
        @endrole

        <!-- The expiration form (initially hidden) -->
           @hasanyrole('super admin | admin')
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

        @endhasanyrole
        @endif

        @push('paidscript')
        <script>
            // Show the expiration form when the approve button is clicked
            $('#approve-button').on('click', function() {
                $('#expiration-form').show();
                $('#approve-button').hide();
            });

            document.getElementById('reject-button').addEventListener('click', function() {
                document.getElementById('reject-form').style.display = 'block';
            });
        </script>
        @endpush
    </div>
</div>
</div>
@endsection