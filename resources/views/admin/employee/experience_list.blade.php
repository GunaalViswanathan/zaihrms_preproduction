<title>Education Details</title>
<div class="mt-1 mb-2 purchase" id="education_front">
    <div class="over-color">
        <div class="table-responsive">
            <table class="table">
                <thead>
                @if(count($user) > 0)
                <tr>
                    <th>Organization</th>
                    <th>Designation</th>
                    <th>Period</th>
                    <th>Actions</th>
                </tr>
                    @endif
                </thead>
                <tbody>
                @forelse($user as $i => $detail)
                    <tr>
                        <td>{{ $detail->organization }}</td>
                        <td>{{ $detail->designation }}</td>
                        <td>{{ $detail->from_year.' - '.$detail->to_year }}</td>
                        <td>
                            <a href="javascript:show_experience_details_popup('{{ $detail->user_id }}','{{url('/experience_detail')}}','edit','{{ $detail->id }}');" title="Edit Education">
                                <button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button>
                            </a>

                            <a href="javascript:show_experience_details_popup('{{ $detail->user_id }}','{{url('/experience_detail')}}','delete','{{ $detail->id }}');"  title="Delete Education">
                                <button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="12">No experience detail(s) found!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
