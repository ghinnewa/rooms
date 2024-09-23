@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/cards.singular')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a class="btn btn-default" href="{{ route('cards.index') }}">
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
            <div class="row d-flex flex-row-reverse">
                @include('cards.show_fields')
            </div>

            <!-- Section to Display the User's Assigned Subjects -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4>Assigned Subjects</h4>
                    @if($subjects->isEmpty())
                        <p>No subjects assigned yet.</p>
                    @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Code</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->title }}</td>
                                    <td>{{ $subject->code }}</td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

            <!-- Additional content for admins -->
            @role('admin|super admin')
            @if(!$card->paid || $card->expiration < Carbon\Carbon::now() && $card->expiration != null)
                <button id="approve-button" class="btn btn-primary">Approve</button>
            @endif
            <button type="button" class="btn btn-danger " id="reject-button">Reject</button>

            <form action="{{ route('cards.reject', $card->id) }}" method="POST" id="reject-form" style="display:none;" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="comment">Reason for Rejection:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Submit Rejection</button>
            </form>
            @endrole

            @endif
        </div>
    </div>
</div>
@endsection
