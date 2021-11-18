# Random Gifts :santa: :mx_claus:
Make your Secret Santa easier. Just put names under the magic tree and le thte magic tell you who's gonna get a gift from who.
This project was made simple and the main goal was to work on an algorythm wich randomly picks a participant and makes sure everyone is gifting someone and receiving a gift. ++ The magic favors gifting someone who is not your family.

### Website
:fire: It's online for a few weeks here : https://random-gifts.osc-fr1.scalingo.io/

### Tech stack 
Symfony, javascript, PHP, bootstrap, twig.

## The Algorythm in details
- First we need to extract each participant form the participants array. We're doing so by using a foreach.
- Then we generate a randomIndex with the randomIndex function
- And generate a randomParticipant with the randomIndex we got;
- We test the association currentParticipant (wich shall become our giver) with the randomParticipant (wich shall become our receiver)
- If the have the same lastName OR if the are the same person we regenerate a randomParticipant until it fills our constraints
- If, for a reason this can't happen (all participants left have the same lastName), we make a simpler test where constraint is only : currentPartcipant can't be the same as our randomParticipant
- We then "save" the association of the current and the random Participants in the results array
- And we delete the receiver of our array so he doesnt get a gift twice
- We do this for every participant **BUT**
- **When there is only 1 participant** left We have to make sure that the current and the random participants are not the same because this can happen (with 1 participant left there is no possibility to change participant)
- If current and random participants are the same : we modify the last results entry and replace the last saved receiver (=lastArrayReceiver) by ou current participant
- Then we insert a new line in results with currentParticipant as giver and lastArrayReceiver as receiver.
- We save this to results and voila ! Now it's time to open those gifts !!

PS Comments in randomPicker are in french in case you need them !
