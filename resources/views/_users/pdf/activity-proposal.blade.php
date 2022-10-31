<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <!-- Prepared By -->
    {{ $form->fromOrguser()->first()->fromUser()->first()->first_name }} {{$form->fromOrguser()->first()->fromUser()->first()->last_name }}
    <!-- organization  -->
    {{$form->myOrg->getOrgName->org_name}}<br>


    <!-- Event Title -->
    {{ $form->event_title }}<br>
    <!-- Date Submitted -->
    {{date('M d, Y', strtotime($form->created_at))}}<br>
    <!-- Duration of event -->
    {{$proposal->duration_val}} {{$proposal->duration_unit}}<br>
    <!-- Target Date of Event -->
    {{date('M d, Y', strtotime($form->target_date))}}<br>
    <!-- Activity Classification  -->
    {{$proposal->classification($proposal->act_classification)}}<br>
    <!-- Organizer Name  -->
    {{$proposal->organizer_name}}<br>
    <!-- organization  -->
    {{$form->myOrg->getOrgName->org_name}}<br>
    <!-- Organizer contact number   -->
    {{$form->fromOrgUser->fromUser->phone_number}}<br>
    <!-- Organizer email  -->
    {{$form->fromOrgUser->fromUser->email}}<br>
    <!-- Description  -->
    {{$proposal->description}}<br>


    <!-- Table: Coorganizers  -->
    @php $i = 1; @endphp
    @foreach($coorganizers as $coorg)<br>
        {{$i++}} 
        {{$coorg->coorganization}}
        {{$coorg->coorganizer}}
        {{$coorg->phone_number}}
        {{$coorg->email}} 
    @endforeach


    <!-- Table: Activity  -->
    @php $i = 1; @endphp
    @foreach($prePrograms as $program)<br>
        {{$i++}} 
        {{$program->activity}}  
        {{date('M d, Y  h:i A', strtotime($program->start_date_time))}} 
        {{date('M d, Y  h:i A', strtotime($program->end_date_time))}} 
    @endforeach

     <!-- Table: Logistical Needs  -->
     @php $i = 1; @endphp
     @foreach($requests as $logistic)<br>
        {{$i++}} 
        {{$logistic->service}} 
        {{$logistic->venue}} 
        {{date('M d, Y ', strtotime($logistic->date_needed))}} 
     @endforeach

    <!-- Primary Target  -->
    {{$proposal->primary_audience}}<br>
    <!-- Num Primary Target  -->
    {{$proposal->num_primary_audience}}<br>

    <!-- Secondary Target  -->
    {{$proposal->secondary_audience}}<br>
    <!-- Num Secondary Target  -->
    {{$proposal->num_secondary_audience}}<br>

    <!-- Rationale -->
    {{$proposal->rationale}}<br>

    <!-- Outcome -->
    {{$proposal->outcome}}<br>


    <!-- Approvers -->

    {{-- Adviser --}}
    {{ $form->getFormAdviser()->first()->fromUser()->first()->first_name }} {{ $form->getFormAdviser()->first()->fromUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->adviser_date_approved))}} <br>

    {{-- Sao --}}
    {{ $form->getFormSao()->first()->staffUser()->first()->first_name }} {{ $form->getFormSao()->first()->staffUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->sao_date_approved))}} <br>

    {{-- AcadServ --}}
    {{ $form->getFormAcadServ()->first()->staffUser()->first()->first_name }} {{ $form->getFormAcadServ()->first()->staffUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->acadserv_date_approved))}} <br>

    {{-- Finance --}}
    {{ $form->getFormFinance()->first()->staffUser()->first()->first_name }} {{ $form->getFormFinance()->first()->staffUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->finance_date_approved))}} <br>



</body>
</html>