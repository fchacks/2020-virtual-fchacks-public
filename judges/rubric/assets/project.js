// This is where all the missions are defined for the season. Ideally, each season, you only have to edit this file, but there are some small areas that need to be changed elsewhere.
// This uses html.js to draw all the missions to the screen.
// Mission loader v2.0 Dynamic Content Replacer

// Defines a blank save for reset


var load2020RP = (function() {

    // Override function in scoring system during the checking for button conflicts


    clearbuffer()

    // Draw the layout

    addToBuffer("<h1>FCHacks Rubrics</h1>")
    addToBuffer("<p>Instructions: Look at the sumbissions and score the team as per the rubric below.</b></p>")
    startRubric()

    startrow()
    addLevels("#e66557", "#e66557", "#e66557", "#e66557")
    closeRow()

    startRow()
    addSubSection("Overall Problem/Solution: Has the team identified a problem that is applicable and important? Is the solution approach practical?", "pink", ["problem"])
    closeRow()

    startRow()
    addOption("problem", "Problem/Solution has not been well developed, practical, and/or irrelevant to the theme.", "1")
    addOption("problem", "Problem/Solution is somewhat well developed, somewhat practical and relevant to the theme", "2")
    addOption("problem", "Problem/Solution is adequately developed, adequately practical and relevant to the theme", "3")
    addOption("problem", "Problem/Solution is exceptionally well developed, practical and highly relevant to the theme.", "4")

    closeRow()


    startRow()
    addSubSection("innovation: How is the team’s solution different from existing solutions?", "pink", ["innovation"])
    closeRow()

    startRow()
    addOption("innovation", "Design lacks innovation and/or does not solve the problem", "1")
    addOption("innovation", "Design differs slightly from existing solutions and solves the problem.", "2")
    addOption("innovation", "Design differs significantly from existing solutions and solves the problem.", "3")
    addOption("innovation", "Design uses an unusual or creative approach and/or solutions are especially effective.", "4")
    closeRow()



    startRow()
    addSubSection("Programming: How sophisticated and well written is the team’s code?", "pink", ["programming"])
    closeRow()

    startRow()
    addOption("programming", "Simplistic code that is not commented or understandable", "1")
    addOption("programming", "Inefficient code with minimal comments", "2")
    addOption("programming", "Somewhat efficient code with adequate comments", "3")
    addOption("programming", "Very efficient, complex, and well commented code", "4")
    closeRow()


    startRow()
    addSubSection("Usability: How easy is the team's prototype to use?", "pink", ["usability"])
    closeRow()

    startRow()
    addOption("usability", "System is difficult to use or poorly documented", "1")
    addOption("usability", "Parts of the system are difficult to use or confusing", "2")
    addOption("usability", "Most tasks are easy to perform", "3")
    addOption("usability", "System use is intuitive and common tasks are streamlined", "4")
    closeRow()



    startRow()
    addSubSection("Pitch: How complete and organized is the team’s solution?", "pink", ["pitch"])
    closeRow()

    startRow()
    addOption("pitch", "Poorly organized presentation. Project is hard to understand.", "1")
    addOption("pitch", "Presentation is somewhat organized, but lacks important details.", "2")
    addOption("pitch", "Presentation is well organized and covers all basic aspects for the project.", "3")
    addOption("pitch", "Excellent presentation that covers all aspects of the project and provides technical detail.", "4")
    closeRow()

    addComments("fcproject")

    endRubric()

    addToBuffer("Total Points: <b style='color:red;' id='projpts'></b>")


    /*
    window.onload = function() {
    check_missions()
    recalc(0,"advantage1",0)
    }
    */

    writebuffer("projectlist")
})();
