<!-- <div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->from == Auth::id()) ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>   
               -->
<div class="message-wrapper">
    @foreach($messages as $message)
        <div class="message {{ ($message->from == Auth::id()) ? 'sender-message' : 'receiver-message'}}">
            <div class="message-text" style="">
                <span class="align-middle">{{ $message->message }}</span>
            </div>
        </div>
        <div class="clearfix"></div>
    @endforeach
</div>

<div class="row" style="position: sticky; bottom: 0;">
    <div class="col-md-12">
        <div class="send-message-box">
            <div class="row">
                <div class="col-md-10 text-center m-0 p-0" style="left:14px;">
                    <input type="text" name="message" class="submit form-control message-input">
                </div>
                <!-- <div class="col-md-1 bg-light-grey m-0 p-0 text-center">
                    <a href="#"><span class="fa fa-paperclip"
                                    style="font-size: 30px;padding: 15px"></span></a>
                </div>
                <div class="col-md-1 bg-maroon-lighter m-0 p-0 text-center">
                    <a href="#"><span class="fa fa-paper-plane bg-maroon-lighter"
                                    style="font-size: 30px;padding: 15px"></span></a>
                </div> -->
            </div>
        </div>
    </div>
</div>


<!-- <div class="input-text">
    <input type="text" name="message" class="submit">
</div> -->