(async () => {
    const express = require("express");
    const fetch = (await import("node-fetch")).default;
    const path = require("path");

    const app = express();

    app.use(express.static(path.join(__dirname, "public")));

    app.get("/", (req, res) => {
        return res.sendFile(path.join(__dirname, "index.html"));
    });

    app.all("/proxy", (req, res) => {
        fetch("http://81997ade-a1ac-4252-82da-2cd1629ebb1a.southcentralus.azurecontainer.io/score", {
            method: req.method,
            headers: req.headers,
            body: JSON.stringify(req.body)
        })
            .then(async resp => {
                return res.status(resp.status).send(await resp.text());
            })
            .catch(err => {
                console.error("Proxy request failed:", err);
                return res.status(500).send(err.stack || String(err));
            });
    });

    app.listen(3000, () => console.log("Server listening"));
})();