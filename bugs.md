# BUGS - RESOLVED
> main bugs found in chat system (messages.php and communities.php) have been fixed.

## Message - FIXED
- **Fixed:** live message updates set to 2 seconds.
- **Fixed:** "loading..." no longer persists for new conversations without messages.
- **Fixed:** Chat switching now properly manages intervals and refreshes all components (header, input, sidebar).

## Communities Chat - FIXED
- **Fixed:** `Uncaught ReferenceError: startLiveUpdates is not defined` resolved by properly scoping the function.
- **Fixed:** Send button functionality restored by resolving script execution errors and ensuring `currentCid` is correctly tracked.
- **Fixed:** "loading..." bug resolved for community chats with no messages.
- **Fixed:** Component refreshing (header, input area) now works correctly when switching communities.

## If any other bugs is found:
- [ ] List any new bugs here

## Steps to take to test the message system for any other bugs
1. **Open two different browsers** (e.g., Chrome and Firefox) or one in Incognito mode.
2. **Login as two different users** who are connected as friends.
3. **Start a conversation** between User A and User B.
4. **Send a message from User A** and verify that User B sees it within 2 seconds without refreshing.
5. **Switch between different chat heads** quickly and verify that the "Loading..." state disappears even if there are no messages.
6. **Start a brand new chat** with a user you haven't messaged before and verify the input area appears correctly.
7. **Test the same for Communities:** Join a community with both users and verify live updates and sending works.
8. **Verify Sidebar updates:** Ensure the latest message text and timestamp update in the sidebar list when a message is received.
