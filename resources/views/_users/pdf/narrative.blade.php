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
     <!-- Narration -->
     {{ $narrative->narration}}<br>

     <!-- Table: programs -->
     @php $i = 1; @endphp
     @foreach($postPrograms as $program)
        {{$i++}} 
        {{$program->activity}}
        {{date('M d, Y', strtotime($program->start_date))}}
        {{date('M d, Y', strtotime($program->end_date))}}
        <br>
      @endforeach
      <br>

    <!-- Table: participants  -->
    @php $i = 1; @endphp
    @foreach($participants as $participant)
        {{$i++}}
        {{$participant->first_name}}
        {{$participant->last_name}} 
        {{$participant->section}}
        {{date('M d, Y', strtotime($participant->participated_date))}}
        <br>
    @endforeach
      <br>
    
    <!-- Official Poster -->
    @foreach($images as $image)
    @if($image->image_type === 'poster')  
        <img src="{{ public_path('storage/'.$image->url)}}"> 
    @endif
    @endforeach
    <br>

    <!-- Event Images -->
    @foreach($images as $image)
    @if($image->image_type === 'photo')
        <img src="{{ public_path('storage/'.$image->url)}}"> 
    @endif
    @endforeach
    <br>


    <!-- Table: Comments -->
    @php $i = 1; @endphp
    @foreach($commentSuggestions as $comment)
    @if($comment->type === 'suggestion')
        {{$i++}}
        {{$comment->message}}
    @endif
    @endforeach
    <br>
    <!-- Table: Comments -->
    @php $i = 1; @endphp
    @foreach($commentSuggestions as $comment)
    @if($comment->type === 'comment')
        {{$i++}}
        {{$comment->message}}
    @endif
    @endforeach
    <br>

    <!-- Ratings -->
    {{$narrative->ratings}}

    <!-- Approvers -->

    {{-- Adviser --}}
    {{ $form->getFormAdviser()->first()->fromUser()->first()->first_name }} {{ $form->getFormAdviser()->first()->fromUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->adviser_date_approved))}} <br>

    {{-- Sao --}}
    {{ $form->getFormSao()->first()->staffUser()->first()->first_name }} {{ $form->getFormSao()->first()->staffUser()->first()->last_name }}
    {{date('M d, Y ', strtotime($form->sao_date_approved))}} <br>
</body>
</html>