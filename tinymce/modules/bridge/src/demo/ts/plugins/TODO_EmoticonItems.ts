import { Fun } from '@ephox/katamari';
import { getDemoRegistry } from '../buttons/DemoRegistry';

// FIX: TODO....
export const registerEmoticonItems = (): void => {
  getDemoRegistry().addButton('emoticon', {
    type: 'button',
    disabled: false,
    onSetup: (_buttonApi) => Fun.noop,
    onAction: (_buttonApi) => {

    }
  });
};
