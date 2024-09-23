@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Title with an Icon -->
            <div class="col-sm-6 ">
                <h1>
                   <!-- Card Icon -->
                    @lang('models/cards.plural')
                </h1>
            </div>

            <!-- Buttons -->
            <div class="col-sm-6">
                <!-- Add New Button with Icon -->
                <a class="btn btn-primary float-left" href="{{ route('cards.create') }}">
                    <i class="fas fa-plus-circle"></i> <!-- Plus Circle Icon -->
                    @lang('crud.add_new')
                </a>
                
                <!-- Print Button with Icon -->
                <div class="d-flex justify-content-end">
                    <button id="print-selected" class="btn btn-primary ml-2 mb-3">
                        <i class="fas fa-print"></i> <!-- Print Icon -->
                        طباعة
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Print Selected Button -->
   

    <div class="content px-3">
   
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                
                @include('cards.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('myscript')
    <script>
    $(document).ready(function() {
    var selectedCards = [];

    // Handle the "Select All" checkbox with event delegation
    $(document).on('click', '#select-all', function() {
        var isChecked = $(this).prop('checked');

        $('.card-checkbox').prop('checked', isChecked);

        $('.card-checkbox').each(function() {
            var cardId = $(this).val();

            if (isChecked) {
                if (!selectedCards.includes(cardId)) {
                    selectedCards.push(cardId);
                }
            } else {
                selectedCards = selectedCards.filter(function(id) {
                    return id !== cardId;
                });
            }
        });

        console.log('Selected cards:', selectedCards); // For debugging purposes
    });

    // Handle individual checkboxes with event delegation
    $(document).on('click', '.card-checkbox', function() {
        var cardId = $(this).val();

        if ($(this).prop('checked')) {
            if (!selectedCards.includes(cardId)) {
                selectedCards.push(cardId);
            }
        } else {
            selectedCards = selectedCards.filter(function(id) {
                return id !== cardId;
            });
        }

        console.log('Selected cards:', selectedCards); // For debugging purposes
    });

    // Handle Print Selected button
    $('#print-selected').on('click', function() {
        if (selectedCards.length === 0) {
            alert('Please select at least one card to print.');
        } else {
            // Open print view in a new window with the selected card IDs
            window.open('/print-cards?card_ids=' + selectedCards.join(','), '_blank');
        }
    });
});

    </script>
@endpush
@endsection