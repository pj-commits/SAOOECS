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
    {{ date('M d, Y', strtotime($form->created_at)) }}<br>
    <!-- Cash Advance -->
    {{ $liquidation->cash_advance}}<br>
    <!-- Cash Advance -->
    {{ $liquidation->deduct}}<br>
    <!-- Total -->
    {{ $liquidation->cash_advance - $liquidation->deduct}}<br>

    <!-- Table :Items -->
    @foreach($items as $item)
        {{$item->item_number}}
        {{date('M d, Y ', strtotime($item->date_bought))}}
        {{$item->item}}
        {{$item->price}}
    @endforeach
    <br>
    <!-- Total -->
    {{$item->price=+$item->price}}
    <br>

    <!-- Table: Proof of payments -->
    @foreach($proofOfPayments as $receipt)
        {{$receipt->item_from}}-{{$receipt->item_to}}
        <img src="{{ public_path('storage/'.$receipt->image)}}"> 
    @endforeach
    <br>


    <!-- Approvers -->

    {{-- Adviser --}}
    {{ $form->getFormAdviser()->first()->fromUser()->first()->first_name }} {{ $form->getFormAdviser()->first()->fromUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->adviser_date_approved))}} <br>


    {{-- Finance --}}
    {{ $form->getFormFinance()->first()->staffUser()->first()->first_name }} {{ $form->getFormFinance()->first()->staffUser()->first()->last_name }}
    {{ date('M d, Y ', strtotime($form->finance_date_approved)) }} <br>
    
</body>
</html>