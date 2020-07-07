const cors = require("cors")({ origin: true });

const puppeteer = require("puppeteer");
// process.setMaxListeners(0);
require("events").EventEmitter.defaultMaxListeners = 55;

const seveAllUrl = [];

const getDataAllP = async (urls) => {
  const browser = await puppeteer.launch({ headless: true });
  const page = await browser.newPage();

  console.log("222", urls);

  const urlGoTo = await urls.map(async (url) => {
    console.log("545", url);
    if (url !== "") {
      await page.goto(url);
      // await page.screenshot({ path: "1.png" });

      try {
        await console.log("1234");
        // Execute code in the DOM
        const dataUrls = await page.evaluate(() => {
          const link = document.querySelectorAll("a");
          const urls = Array.from(link).map((v) => v.href);
          console.log("33333", link);
          return urls;
        });
        await browser.close();
        return dataUrls;
      } catch (err) {
        console.log(err);
        next(err);
      }
    } else {
      return;
    }
  });

  const urlGoToPrams = await Promise.all(urlGoTo).then(async (res) => {
    if ((res == []) & (res == undefined)) {
      return;
    }
    seveAllUrl.push(...res);
    console.log("as12", res, seveAllUrl);

    await getDataAllP(...res);
  });
};

getDataAllP(["https://www.google.com/search?q=fs"]);
