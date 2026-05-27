(function (window) {
  const config = window.LidingoNetpublicatorBulletinboard || {};
  const replacements = new Map([
    ['SÃ¶ker', 'Söker'],
    ['Ã„ndra textstorlek', 'Ändra textstorlek'],
    ['FÃ¶rsta sidan', 'Första sidan'],
    ['FÃ¶regÃ¥ende sida', 'Föregående sida'],
    ['NÃ¤sta sida', 'Nästa sida'],
    ['Ett okÃ¤nt fel har uppstÃ¥tt. Ladda om sidan eller fÃ¶rsÃ¶k igen om en stund.', 'Ett okänt fel har uppstått. Ladda om sidan eller försök igen om en stund.'],
    ['Â»', '»'],
  ]);

  if (!config.id || !window.NPPublicBulletinBoard || !document.getElementById('bulletinboard')) {
    return;
  }

  const fixMojibake = function (root) {
    if (!root) {
      return;
    }

    const fixString = function (value) {
      let nextValue = value;

      replacements.forEach(function (replacement, search) {
        nextValue = nextValue.replaceAll(search, replacement);
      });

      return nextValue;
    };

    const walker = document.createTreeWalker(root, window.NodeFilter.SHOW_TEXT);
    let textNode = walker.nextNode();

    while (textNode) {
      if (textNode.nodeValue) {
        const nextValue = fixString(textNode.nodeValue);
        if (nextValue !== textNode.nodeValue) {
          textNode.nodeValue = nextValue;
        }
      }

      textNode = walker.nextNode();
    }

    root.querySelectorAll('[title], [aria-label]').forEach(function (element) {
      ['title', 'aria-label'].forEach(function (attribute) {
        const currentValue = element.getAttribute(attribute);

        if (!currentValue) {
          return;
        }

        const nextValue = fixString(currentValue);
        if (nextValue !== currentValue) {
          element.setAttribute(attribute, nextValue);
        }
      });
    });
  };

  window.NPPublicBulletinBoard.init({
    id: config.id,
  });

  const bulletinboard = document.getElementById('bulletinboard');
  fixMojibake(bulletinboard);

  const observer = new window.MutationObserver(function () {
    fixMojibake(bulletinboard);
  });

  observer.observe(bulletinboard, {
    childList: true,
    subtree: true,
  });
})(window);
