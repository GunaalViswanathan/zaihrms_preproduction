<table>
    <thead>

        <tr>
            <th><strong>Search By : {{$val['sort_by']}}</strong></th>
            <th><strong>@if($val['from_date']) {{date('d-m-Y',strtotime($val['from_date']))}} @endif @if($val['to_date']) {{date('d-m-Y',strtotime($val['to_date']))}} @endif</strong></th>
            @if(!userHasRole('employee'))
            @if(isset($val['resource']))
            <th><strong>{{$resouceName = \App\Models\User::find($val['resource']) ? \App\Models\User::find($val['resource'])->full_name:""}}</strong></th>
            @endif
            @endif
        </tr>
    </thead>
</table>
<table class="table">
    <thead>
        <tr>
            <th><strong>S.NO</strong></th>
            <th><strong>Task Date</strong></th>
            <th><strong>Work Mode</strong></th>
            @if(!userHasRole('employee'))
            <th><strong>Resource</strong></th>
            @endif
            <th><strong>Worked Details</strong></th>
            <th><strong>Hours Spent</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
        @forelse($users as $s => $report)
        @php
        $count_hours = $report->hours_spent;
        $total +=$count_hours;
        @endphp
        <tr>
            <td>{{ $s+1 }}</td>
            <td>{{ date('d-m-Y',strtotime($report->date))}}</td>
            <td>{{ WorkMode($report->work_mode)}}</td>
            @if(!userHasRole('employee'))
            <td>{{ $report->user->full_name}}</td>
            @endif
            <td>{{$report->description}}</td>
            <td>{{ $report->hours_spent}}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="12">No Projects found!</td>
        </tr>
        @endforelse
        @if(!userHasRole('employee'))
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total Hours Spent</b></td>
            <td>{{$total}}</td>
        </tr>
        @else
        <tr>
            <td></td>
            <td></td>
            @if(userHasRole('employee'))
            <td></td>
            @endif
            <td><b>Total Hours Spent</b></td>
            <td>{{$total}}</td>
        </tr>
        @endif

    </tbody>
    </table>