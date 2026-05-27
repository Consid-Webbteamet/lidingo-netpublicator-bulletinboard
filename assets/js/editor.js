(function (blocks, blockEditor, element, i18n) {
  const el = element.createElement;
  const __ = i18n.__;
  const useBlockProps = blockEditor.useBlockProps;

  blocks.registerBlockType('lidingo/netpublicator-bulletinboard', {
    title: __('Anslagstavla', 'lidingo-netpublicator-bulletinboard'),
    category: 'widgets',
    icon: 'megaphone',
    edit: function () {
      const blockProps = useBlockProps({
        className: 'lidingo-netpublicator-bulletinboard-editor',
      });

      return el(
        'div',
        blockProps,
        el(
          'div',
          {
            className: 'lidingo-netpublicator-bulletinboard-editor__content',
            style: {
              border: '1px solid #1e1e1e',
              padding: '16px',
              background: '#fff',
            },
          },
          el(
            'strong',
            null,
            __('Anslagstavla', 'lidingo-netpublicator-bulletinboard')
          ),
          el(
            'p',
            {
              style: {
                margin: '8px 0 0',
              },
            },
            __('Det här blocket visar kommunens anslagstavla från Netpublicator och själva anslagstavlan visas på sidan.', 'lidingo-netpublicator-bulletinboard')
          )
        )
      );
    },
    save: function () {
      return null;
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.element,
  window.wp.i18n
);
