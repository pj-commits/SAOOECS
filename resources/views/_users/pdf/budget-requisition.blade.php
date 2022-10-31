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
    <!-- Control Number -->
    {{ $form->control_number }}<br>
    <!-- type -->
    {{ $requisition->payment }}<br>
    <!-- date needed -->
    {{ date('M d, Y ', strtotime($requisition->date_needed)) }}<br>
    <!-- Department -->
    {{ $requisition->getDepartment()->first()->name }}<br>


    <!-- Table: Items -->
    @php 
    $i = 1;
    $total = 0;
    @endphp
    @foreach($items as $item)
        {{$i++}}
        {{$item->purposes}}
        {{$item->quantity}}
        {{$item->price}}
        <br>
    @php $total += $item->price * $item->quantity @endphp
    @endforeach
        {{ $total }}
    <br>


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