const express = require("express");
const { exec } = require("child_process");
const path = require("path");
const axios = require("axios");
const cors = require("cors");
var http = require("http");
const app = express();
var server = http.createServer(app);
var io = require("socket.io")(server);
var CronJob = require("cron").CronJob;
const filePath = "D:/Train skill/Laravel/crawl-app/batch.bat";
const rootName = path.parse(filePath).root;
const filePathTo = `${rootName}"${filePath.replace(rootName, "")}"`;

app.use(cors());

const valueTotalLink = async () => {
    const value = await axios.get("http://localhost:8000/return-links");
    return value?.data;
};

const resetLink = async () => {
    const valResetLink = await axios.post("http://localhost:8000/reset-link");
};

let isRunning = false;
io.on("connection", function (socket) {
    socket.emit("isRunning", isRunning);
    console.log("Co nguoi vua ket noi" + socket.id);
    var job = new CronJob(
        "*/1 * * * * *",
        async function () {
            console.log("aaa" + Date.now());
            const val = await valueTotalLink();
            socket.emit("valueOn", val);
        },
        null,
        false,
        "Asia/Ho_Chi_Minh"
    );

    socket.on("start:job", (dta) => {
        isRunning = true;
        job.start();
    });

    socket.on("end:job", async (dta) => {
        isRunning = false;
        await resetLink();
        job.stop();
    });
});

const PORT = 3015;

app.post("/run-command", async function (req, res) {
    try {
        const exec_command = exec(`start ${filePathTo}`);
    } catch (error) {}

    return res.json("successfully");
});

server.listen(PORT, (error) => {
    if (!error)
        console.log(
            "Server is Successfully Running,and App is listening on port " +
                PORT
        );
});
