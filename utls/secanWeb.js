const cors = require("cors")({ origin: true });

const cheerio = require("cheerio");
const getUrls = require("get-urls");
const fetch = require("node-fetch");

const getAllData = (text) => {
  const Urls = Array.from(getUrls(text));

  const Requests = Urls.map(async (url) => {
    const Res = await fetch(url);
    const Html = await Res.text();
    const $ = cheerio.load(Html);

    const links = [];
    await $("a").each(() => {
      console.log(this.href);
      links.push(this.href);
    });

    return await links;
  });

  Promise.all(Requests).then((res) => {
    console.log("33333", res);
  });
};

getAllData("https://www.google.com/search?q=ey7");
