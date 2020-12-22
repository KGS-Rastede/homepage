import { PluginDef } from '@fullcalendar/common';

declare type Success = (rawFeed: string, xhr: XMLHttpRequest) => void;
declare type Failure = (error: string, xhr: XMLHttpRequest) => void;
declare function requestICal(url: string, successCallback: Success, failureCallback: Failure): void;
declare const _default: PluginDef;

export default _default;
export { requestICal };
