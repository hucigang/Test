-- 拟写的一份存储过程
-- 作用：更新传感器数据库（更新，新建）

CREATE PROCEDURE sp_updateChuanGanQi
@id int(4), @wendu char(10), @shidu char(10), @shuifa char(10), @qita char(10)
AS
declare @i int
SELECT @i=count(*) from chuanGanQi where id=@id
if @i=0
BEGIN
	INSERT chuanGanQi VALUES(@id, @wendu, @shidu, @shuifa, @qita)
END
ELSE BEGIN
UPDATE chuanGanQi
	id=@id
	wendu=@wendu
	shidu=@shidu
	shuifa=@shuifa
	qita=@qita
END
GO