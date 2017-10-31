#coding:utf-8
import json
import urllib2
import sys

# 传感器上传接口
URL 	= 'http://localhost:8092/07phppostcgq.php'


def POST_ChaunGanQi(cliid, wendu, shidu, shuifa, qita):
	'''python 模拟终端上传传感器数据
	'''
	ChanGanQiArr	= {'id':cliid,'wendu':wendu,'shidu':shidu, 'shuifa':shuifa, 'qita':qita}
	POST_DATA		= 'jsonStr=' + json.dumps(ChanGanQiArr)
	req				= urllib2.Request(URL, POST_DATA.encode('utf-8'))
	res 			= urllib2.urlopen(req)
	return res.read()


def main():
	cliid, wendu, shidu, shuifa, qita = sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4],  sys.argv[5]
	res = POST_ChaunGanQi(cliid, wendu, shidu, shuifa, qita)
	#print(res)


if __name__ == '__main__':
	main()