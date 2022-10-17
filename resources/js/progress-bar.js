// import { exec } from "child_process";

const progressBar = document.getElementById("progress-bar");
let statusVal = 0;
let id = null;
let speed = 500;

id = setInterval(() => {
    updateProgressBar();
}, speed);

function updateProgressBar() {
    const isMaxVal = statusVal === 100;

    if (isMaxVal) {
        clearInterval(id);
        statusVal = 0;

        return setTimeout(() => {
            id = setInterval(() => {
                updateProgressBar();
            }, speed);
        }, 2000);
    }

    statusVal++;
    progressBar.dataset.status = statusVal + "%";
    progressBar.setAttribute(
        "style",
        `--__progress-bar__status_wh: ${statusVal}%;`
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
