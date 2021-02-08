import WechatJSSDK from 'wechat-jssdk';
import http from "./http";

async function jssdkInit(jsApiList = []) {
  const config = await http.post('wechat/jssdk', {
    url: window.location.href,
    jsApiList: jsApiList,
  })
  const wechat = new WechatJSSDK(config)
  await wechat.initialize()
  return wechat
}

export default {
  async initShare(shareConfig) {
    // https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html#10
    const wechat = await jssdkInit(['updateAppMessageShareData', 'updateTimelineShareData'])
    wechat.callWechatApi('updateAppMessageShareData', shareConfig)
    wechat.callWechatApi('updateTimelineShareData', shareConfig)
  }
}
