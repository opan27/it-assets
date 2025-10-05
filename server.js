const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const bodyParser = require("body-parser");

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: { origin: "*" }
});

app.use(bodyParser.json());

io.on("connection", (socket) => {
  console.log("User connected:", socket.id);

  socket.on("register", (userId) => {
    socket.join("user_" + userId);
    console.log("User registered:", userId);
  });
});

app.post("/notify", (req, res) => {
  const { userId, message } = req.body;
  io.to("user_" + userId).emit("notification", { message });
  res.json({ success: true });
});

server.listen(3000, () => {
  console.log("Notifier server running on http://localhost:3000");
});
