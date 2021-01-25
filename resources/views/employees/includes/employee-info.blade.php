<div class="card">
    <div class="card-header h4">{{__('employee')}} {{__('information')}}</div>
    <div class="card-body">
        <table class="table table-sm">
            <tr>
                <th>{{__('photo')}}</th>
                <td>:</td>
                <td><img class="rounded"
                        src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}"
                        alt="img" width="80px"></td>
            </tr>
            
            <tr>
                <th>{{__('status')}}</th>
                <td>:</td>
            <td> <span class="badge px-4 {{$statusClass[$employee->status]}}">{{$status[$employee->status]}}</span></td>
            </tr>
            <tr>
                <th>{{__('name')}}</th>
                <td>:</td>
                <td>{{$employee->name}}</td>
            </tr>
            <tr>
                <th>{{__('contact')}}</th>
                <td>:</td>
                <td>{{$employee->contact_no}}</td>
            </tr>
            <tr>
                <th>{{__('department')}}</th>
                <td>:</td>
                <td>{{$employee->department->title}}</td>
            </tr>
            <tr>
                <th>{{__('rank')}}</th>
                <td>:</td>
                <td>{{$employee->rank->title}}</td>
            </tr>
            <tr>
                <th>{{__('monthly')}} {{__('salary')}}</th>
                <td>:</td>
                <td>{{$employee->salary}} {{__('Tk.')}}</td>
            </tr>

            @if ($employee->payables()->isNotEmpty())

            <tr class="bg-secondary">
                <th>{{__('payable')}} {{__('salary')}} - {{__('last')}} {{__('month')}} ({{$employee->payable() ? $m[$employee->payable()->month] : 'N/A'}})</th>
                <td>:</td>
                <td class="font-weight-bold">{{$employee->payable()->payable_salary ?? '0'}} {{__('Tk.')}}</td>
            </tr>
            <tr class="bg-danger">
                <th>{{__('total')}} {{__('payable')}} {{__('salary')}}</th>
                <td>:</td>
                <td class="font-weight-bold">{{$employee->total_due()}} {{__('Tk.')}}</td>
            </tr>

            @endif

        </table>
    </div>
</div>