<table>
    <thead>
        <tr>
            <th><strong>Search By: {{$val['sort_by']}}</strong></th>
            <th><strong>@if($val['from_date']) {{date('d-m-Y',strtotime($val['from_date']))}} @endif @if($val['to_date']) {{date('d-m-Y',strtotime($val['to_date']))}} @endif</strong></th>
            @if(!userHasRole('employee'))
            @if(isset($val['resource']))
            <th><strong>{{$resouceName = \App\Models\User::find($val['resource']) ? \App\Models\User::find($val['resource'])->full_name:""}}</strong></th>
            @endif
            @endif
            @if($val['project_name'])
            <th><strong>{{$projectName = \App\Models\Project::find($val['project_name'])->project_name}}</strong></th>
            @endif
        </tr>
    </thead>
</table>
<table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th><strong>S.No</strong></th>
            <th><strong>Date</strong></th>
            @if(!userHasRole('employee'))
            <th><strong>Employee Name</strong></th>
            @endif
            <th><strong>Project Name</strong></th>
            <th><strong>Worked Details</strong></th>
            <th><strong>Hours Spent</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
        @if(($val['project_name']!='') || ($val['resource']!='') || ($val['from_date']!='') || ($val['to_date']!=''))
        @forelse($users as $s=>$report)
        @php
        $count_hours = $report->hours_spent;
        $total +=$count_hours;
        @endphp
        <tr>
            <td>{{++$s}}</td>
            <td>{{ date('d-m-Y',strtotime($report->date))}}</td>
            @if(!userHasRole('employee'))
            <td>{{ $report->user->full_name}}</td>
            @endif
            <td>{{ $report->project ? $report->project->project_name : 'Bench'}}</td>
            <td>{{$report->description}}</td>
            <td>{{ $report->hours_spent}}</td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="12">No Records found!</td>
        </tr>
        @endforelse
        <tr>
            <td></td>
            <td></td>
            <td></td>
            @if(!userHasRole('employee'))
            <td></td>
            @endif
            <td><b>Total Hours Spent</b></td>
            <td>{{$total}}</td>
        </tr>
        @else
        <tr>
            <td class="text-center" colspan="12">No Records found!</td>
        </tr>
        @endif
    </tbody>
</table>
