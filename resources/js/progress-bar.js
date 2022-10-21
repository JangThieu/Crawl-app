// import { exec } from "child_process";

// const progressBar = document.getElementById("progress-bar");
// let statusVal = 0;
// let id = null;
// let speed = 500;

// id = setInterval(() => {
//     updateProgressBar();
// }, speed);

function updateProgressBar(val) {
    // const isMaxVal = statusVal === 100;

    // if (isMaxVal) {
    //     clearInterval(id);
    //     statusVal = 0;

    //     return setTimeout(() => {
    //         id = setInterval(() => {
    //             updateProgressBar();
    //         }, speed);
    //     }, 2000);
    // }

    statusVal++;
    progressBar.dataset.status = statusVal + "%";
    progressBar.setAttribute(
        "style",
        `--__progress-bar__status_wh: ${val}%;`
    );
}

// const btnClick = document.getElementById("run-batch-file");

// $("button[id=run-batch-file]").click(function () {
//     runBatchFile();
// });

// function runBatchFile() {
//     // console.log("asdasd");
//     // const { exec } = require("child_process");
//     var yourscript = exec("start batch.bat", (error, stdout, stderr) => {
//         console.log(stdout);
//         console.log(stderr);
//         if (error !== null) {
//             console.log(`exec error: ${error}`);
//         }
//     });
// }


var sidebar = document.getElementById('sidebar');

function sidebarToggle() {
    if (sidebar.style.display === "none") {
        sidebar.style.display = "block";
    } else {
        sidebar.style.display = "none";
    }
}

var profileDropdown = document.getElementById('ProfileDropDown');

function profileToggle() {
    if (profileDropdown.style.display === "none") {
        profileDropdown.style.display = "block";
    } else {
        profileDropdown.style.display = "none";
    }
}


/**
 * ### Modals ###
 */

function toggleModal(action, elem_trigger)
{
    elem_trigger.addEventListener('click', function () {
        if (action == 'add') {
            let modal_id = this.dataset.modal;
            document.getElementById(`${modal_id}`).classList.add('modal-is-open');
        } else {
            // Automaticlly get the opned modal ID
            let modal_id = elem_trigger.closest('.modal-wrapper').getAttribute('id');
            document.getElementById(`${modal_id}`).classList.remove('modal-is-open');
        }
    });
}


// Check if there is modals on the page
if (document.querySelector('.modal-wrapper'))
{
    // Open the modal
    document.querySelectorAll('.modal-trigger').forEach(btn => {
        toggleModal('add', btn);
    });

    // close the modal
    document.querySelectorAll('.close-modal').forEach(btn => {
        toggleModal('remove', btn);
    });
}
