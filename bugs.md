# BUGS
> main bugs are found in chat system within: (messages.php -> php_message/) and (communities.php -> php_community_message); for now just focus to solve bugs on message system, in this md add other posible bugs if you encounter any;

## Message
- no live message under 2 seconds can find new message when clicked message chat head or change in chat head acrive also same prob in chat head sub messages
- when new chat is started chat section is showing loading...

## Communities Chat
- In Console found this error:
```
communities.php?target=3:283 Uncaught ReferenceError: startLiveUpdates is not defined
    at window.switchCommunity (communities.php?target=3:283:9)
    at HTMLDivElement.onclick (communities.php?target=3:1:1)
```
-
- the send button is not working even thouh i can type
- I dont know how but in some community caht i can type in message box but cant send message and the loaidng... is showing

## If any other bugs is found:
>please enlist the bugs may ouccer here

## Steps to take to test the message system for any other bugs
> pleans enist the step to follow to test system