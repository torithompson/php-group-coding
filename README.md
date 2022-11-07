Check In Meeting - Nov 10 @ 10:30am
Each student keeps their own record of their teammates progress. For each student in your group, document the following. You will need this information later.
-	Was their work done in a timely manner? 
-	Were they on time and engaged in the team meeting? 

To Do List
1.	Each member speaks to the following items. Be sure to record your teammates comments and progress.
o	what I have been working on since last meeting.
o	what problems did I have and how they were resolved.
o	what are my problem areas.
o	what I will do next.
2.	Confirm date and time for your next team meeting. 
3.	After the meeting, complete your assigned coding tasks.

Code Integration Meeting - Nov 17 @ 11:30am
Each student keeps their own record of their teammates progress. For each student in your group, document the following. You will need this information later.
-	Was their work done in a timely manner? 
-	Were they on time and engaged in the team meeting?  

To Do List
1.	Decide which team member is responsible for submitting the code by the deadline.
2.	Decide which team member is responsible for submitting the video by the deadline.
3.	Combine code and get the application working. 
4.	Create the presentation. If needed, schedule an additional meeting before the deadline.
GUI
There is exactly one web page to this project. Include the following:
-	Heading with all students first and last names.
-	Colour scheme.
-	Horizontal menu with 3 main items: File, Edit, Font. Each will hold a dropdown menu.
-	File drop down has buttons for New, Open and Save.
-	Edit drop down with:
o	Find label and search textbox.
o	Case sensitive label and checkbox.
o	Find button.
-	Font drop down allows the user to change the font in the text area. 
o	Font label and list box. Fonts will be read in from the fontNames table and loaded in to the listbox.  
o	Font size label and listbox. The listbox has 3 items: small, medium and large. 
-	Large text area. 
o	On initial load and on File New, text area displays a placeholder: enter text here.
o	On save and open, text area displays file contents. 
-	Additional page elements and styling are optional.
 
Code Design
This code is about understanding concepts and thinking through an effective solution. There are not a lot of code lines. The main php file is likely less than 200 lines; javascript 10 – 15 lines.
Pair A Tasks 
Code function drawMenu to create the GUI for the dropdown menus. To build the dropdown menu design, you can create your own or use one from the internet. Call drawFileDropDown, drawEditDropDown and drawFontDropDown as appropriate. 

Code functions drawFileDropDown and drawEditDropDown. Do not code drawFontDropDown as that is being done by another pair. The above functions have no parameters and do not return a value.

Code function saveFile and function openFile. Handy functions are fwrite and fread. The filename is editor.dat. Display the messages below as appropriate:
-	File saved.
-	Error Saving File.
-	File opened.
-	Error opening file. 

Function saveFile has one parameter: the text to be saved to the file (one long string). It does not return a value. Function openFile has no parameters and returns the text retrieved from the file.

Note that an error is given if the user tries to open a file when editor.dat does not exist. Use the file_exists function in openFile. If the file does not exist, display Editor.dat does not exist. Please save file first. 

Functions can be written and tested before main is ready. File New does not require its own function. You do not have to account for the user forgetting to click Save.

Pair B Tasks
Code function drawFontDropDown. For this work, use COMP 205 and COMP 220 methodologies. The JavaScript for this web site is at the complexity level of COMP 205. Functionality:
-	Retrieve font names from table fontNames and load into the list box. Assume the number of fonts and the font names will change over time as the table is updated regularly by another application. 
-	Using javascript, change the font name in the text area to the user selected font name.
-	Display a font size list box containing 3 values: small, medium and large.
-	Using javascript, change the font size in the text area to the user selected font size.

The function will be called by the drawMenu function. If your JavaScript event will not fire, try refreshing the browser with ctrl-F5. Note that font changes are for display only. They will not be saved to the file. To do so, an api is required. 

Pair C Tasks
Code function findTextInFile. Find results are displayed with an echo statement. Sample results when searching for feline cat: 

String feline cat not found
Feline cat was found at position 4. 

When displaying the position number to the user, the first position should be 1, not 0.

The function can be written and tested before main is ready. While waiting for main to be completed, assign sample values for the text area and for the case sensitive variable.

Code main to manage the GUI. This portion of the code involves clear program design and planning: more time will be spent on this than coding. Main is responsible for the features listed below.  
-	Save text area contents to the post array.  
-	Call the following functions, as appropriate. 
o	openFile. 
o	saveFile. 
o	findTextInFile.
o	drawMenu.
-	Implement File New: display the place holder in the text area. 
-	Display the text area with the appropriate contents. Attributes:
	autofocus so focus goes to it on page load.
	wrap: hard.
	spell check: true.
-	For testing purposes
o	Create New, Open, Save and Find html buttons. When all editor code is combined, remove the buttons. 
o	Write an echo statement as a placeholder for each function call. For example:
echo "Running the open function here.";




Presentation
As a team, discuss and answer the Project Debrief questions below. Decide who will present each component. The presentation time should be split evenly among the teammates. 

Create a 15 – 20 minute video of a walkthrough of your application. Before you start recording, load your code in Visual Code and display the application in Chrome. Your walk through should include the following:
-	Demonstration of all software features, from the user’s perspective. Be sure to cover all components, even if they are not working. Presentation should consist of the steps below in the provided order.
o	File menu
	File New. Type in a few sentences. 
	File Save.
	File New.
	File Open.
o	Edit menu
	Find. Perform a successful case sensitive search.
	Find. Perform an unsuccessful case sensitive search.
	Find. Perform a successful case insensitive search.
	Find. Perform an unsuccessful case insensitive search.
o	Font menu
	Change font name to Brushscript and size to large.
	Change font name to Courier New and size to small.
-	Each student speaks for 1 - 2 minutes about the work they completed. Discuss:
o	Work you completed and challenges you faced.
o	Present a walkthrough of the code you have written. Walk throughs and debriefs are commonly used in the hiring process and in the workforce. Be sure to cover all code lines. You do not have to walk through the include file or the css file. A sample walk through is shown at https://www.youtube.com/watch?v=elcijdLbjks. Start at the 5:13 mark and watch to 6:30.
-	Project Debrief questions
o	As a team, discuss the answers to the following questions. Note this question is asking about the team, individuals, relationships and soft skills. It is not about the software features or the coding. One team member to present the answers to the following:
	What worked well?
	What did not work well?
	What could the team have done differently to have better results? 
