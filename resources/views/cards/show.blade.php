@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/cards.singular')</h1>
            </div>
            <div class="col-sm-6 text-left">
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
لم تقم بإضافة بطافة بعد 

        </div>
            <a href="{{ route('cards.create') }}" class="btn btn-primary">اضف بطاقة</a>
            @else
            <div class="row d-flex flex-row-reverse">
                @include('cards.show_fields')
            </div>

            <!-- Section to Display the User's Assigned Subjects -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4>المواد
                        
                    </h4>
                    @if($subjects->isEmpty())
                        <p>لايوجد مواد مضافة بعد</p>
                    @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>المادة</th>
                                <th>الرمز</th>
                            
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
                <button id="approve-button" class="btn btn-primary">قبول</button>
            @endif
            <button type="button" class="btn btn-danger " id="reject-button">رفض</button>

            <form action="{{ route('cards.reject', $card->id) }}" method="POST" id="reject-form" style="display:none;" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="comment">سبب الرفض:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger"> اتمام الرفض</button>
            </form>
            @endrole


            @endif

            @role('admin|super admin')
        <form class="form-group " id="expiration-form" action="{{ route('paid') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id" value={{ $card->id }}>
            <label for="expiration">مدة انتهاء الصلاحية:</label>
            <select id="expiration" name="expiration" class="form-control">
                <option value="6m"> 6 فصل</option>
                <option value="1y">1 سنة</option>
                <option value="2y">2 سنتين</option>
            </select>
            <input type="submit" class="btn btn-primary my-3" value="Submit">
        </form>

        @endrole
        @role('student')
        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-primary">تعديل بياناتي </a>
        <p class="text-warning mt-3">*ملاحظة : اذا قمت بالتعديل على بياناتك فسترجع بطاقتك الى وضع الانتظار</p>
        @endrole

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
