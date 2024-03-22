@if ($Complaints->count() > 0)
    @foreach ($Complaints as $Complaint)
        <tr>
            <td><a onclick="freeMeetmodal('{{ $Complaint->id }}','{{ $Complaint->status }}')"
                    style="cursor: pointer;font-size:20px;color:blue;">{{ $Complaint->TicketID }}</a>
            </td>
            <td>{{ optional(App\Models\User::find($Complaint->user_id))->username == ''?optional(App\Models\User::find($Complaint->user_id))->first_name.' '.optional(App\Models\User::find($Complaint->user_id))->last_name:optional(App\Models\User::find($Complaint->user_id))->username }}
            </td>
            <td>{{ $Complaint->subject }}</td>
            <td>{{ $Complaint->type }}</td>
            <td>
                @if (empty($Complaint->booking_id))
                    N/A
                @else
                    {{ $Complaint->booking_id }}
                @endif
            </td>
            <td>
                @if ($Complaint->status == 'Pending')
                    <span class="badge badge-warning px-3">{{ $Complaint->status }}</span>
                @elseif($Complaint->status == 'Processing')
                    <span class="badge badge-danger px-2">{{ $Complaint->status }}</span>
                @else
                    <span class="badge badge-success px-2">{{ $Complaint->status }}</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($Complaint->created_at)->format('F j, Y \a\t g:i A') }}
            </td>
        </tr>
    @endforeach
    <!--<tr style="border: none;">-->
    <!--    <td class="text-end" colspan="6" style="border: none;">-->
    <!--        {!! $Complaints->links('pagination.custom') !!}-->
    <!--    </td>-->
    <!--</tr>-->
@else
    <tr>
        <td class="text-center" colspan="6">Record not found</td>
    </tr>
@endif
