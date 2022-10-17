import { exec } from "child_process";

function runBatchFile() {
    console.log("asdasd");
    var yourscript = exec("start batch.bat", (error, stdout, stderr) => {
        console.log(stdout);
        console.log(stderr);
        if (error !== null) {
            console.log(`exec error: ${error}`);
        }
    });
}
// runBatchFile()
