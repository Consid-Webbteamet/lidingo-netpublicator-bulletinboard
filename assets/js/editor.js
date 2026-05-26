(function (blocks, element, i18n) {
  const el = element.createElement;
  const __ = i18n.__;

  blocks.registerBlockType('lidingo/netpublicator-bulletinboard', {
    title: __('Anslagstavla', 'lidingo-netpublicator-bulletinboard'),
    category: 'widgets',
    icon: 'megaphone',
    edit: function () {
      return el(
        'div',
        {
          className: 'lidingo-netpublicator-bulletinboard-editor',
        },
        __('Anslagstavla', 'lidingo-netpublicator-bulletinboard')
      );
    },
    save: function () {
      return null;
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.i18n);
