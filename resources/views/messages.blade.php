@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="list-group">
            @if($threads->count() > 0)
                @foreach($threads as $thread)
                    @if($thread->lastMessage)
                        <a href="#" class="list-group-item">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <span class="h5">{{ $thread->title }}</span>
                                    @if($thread->unreadMessagesCount > 0)
                                        <span class="label label-success">{!! $thread->unreadMessagesCount !!}</span>
                                    @endif
                                </div>
                                <span class="text-muted pull-right">{{ $thread->lastMessage->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-muted no-margin">{{ str_limit($thread->lastMessage->body, 35) }}</p>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
        
@endsection
