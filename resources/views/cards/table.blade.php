<div class="table-responsive">
    <table class="table" id="cards-table">
        <thead>
            <tr>
                <th>p.p</th>
                <th>M.N</th>
                <th>Name</th>
                <th>Job Title </th>
                <th>Phone</th>
                <th>Email</th>
                <th>Paid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td><img src="{{ asset('storage/images/'.$card->image) }}" style="width:50px; height:50px" class="rounded-circle" alt=""></td>
                    <td>{{ $card->membership_number }}</td>
                    <td>{{ $card->name_ar }} <br>
                        <p class="" style="font-size:10px">{{ $card->name_en }}</p>
                    </td>
                    <td>{{ $card->job_title_ar }} <br>
                        <p class="" style="font-size:10px">{{ $card->job_title_en }}</p>
                    </td>
                    <td>{{ $card->phone1 }} <br>
                        <p class="" style="font-size:10px">{{ $card->phone2 }}</p>
                    </td>
                    <td>{{ $card->email }}</td>
                    <td>{{ $card->paid }}</td>

                    <td width="120">
                        {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('cards.show', [$card->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('cards.edit', [$card->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
