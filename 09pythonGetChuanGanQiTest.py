#coding=utf-8
# 演示用
P=				'python WEB传感器数据下载接口测试'

import urllib2
import json
from time import sleep
import platform, os

URL = 'http://localhost:8092/05phpJsonCGQGet.php'

class __clearSCR:
	'''跨平台刷新屏幕
	'''
	def __init__(self):
		if 'Windows' in platform.system():
			self.__call__ = self.windowsCL
		else:
			self.__call__ = self.linuxCL

	def windowsCL(self):
		os.system('cls')

	def linuxCL(self):
		os.system('clear')

clearSCR = __clearSCR()


def GET_JSON_DATA(URL):
	'''GET方法获取数据
	'''
	res 	= urllib2.urlopen(URL)
	jsonStr = res.read()
	values	= json.loads(jsonStr)
	return values


def main_loop():
	while True:
		sleep(1)
		clearSCR()
		print('python WEB传感器数据下载接口测试\n')
		values = GET_JSON_DATA(URL)
		for i in values:
			print(u"ID：%s \t温度：%s\t湿度：%s\t水阀：%s\t其他：%s" % 
				(i['id'], i['wendu'], i['shidu'], i['shuifa'], i['qita']))


def main():
	main_loop()


if __name__ == '__main__':
	main()
