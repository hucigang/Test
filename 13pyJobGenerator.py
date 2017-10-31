#coding:utf-8
p = 			'python模拟客户端调用任务上传接口测试'
import json
import urllib2
import sys

# 传感器上传接口
URL 	= 'http://localhost:8092/12phpJobUploadTest.php'


def POST_JOB(cliid, shuifa):
	'''python 模拟终端上传控制指令
	'''
	ChanGanQiArr	= {'clientid':cliid, 'shuifa':shuifa}
	POST_DATA		= 'jsonStr=' + json.dumps(ChanGanQiArr)
	req				= urllib2.Request(URL, POST_DATA.encode('utf-8'))
	res 			= urllib2.urlopen(req)
	return res.read()


def main():
	cliid, shuifa = sys.argv[1], sys.argv[2]
	res = POST_JOB(cliid, shuifa)
	print(res)


if __name__ == '__main__':
	main()