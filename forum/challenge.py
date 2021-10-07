import sqlite3

from hacksport.problem import files_from_directory, PHPApp, ProtectedFile


class Problem(PHPApp):
    files = files_from_directory("webroot/") + [ProtectedFile("forum.db")]
    php_root = "webroot/"
    num_workers = 5

    def setup(self):
        conn = sqlite3.connect("forum.db")
        conn.cursor().execute("PRAGMA journal_mode = MEMORY")
        conn.commit()
        
        c = conn.cursor()
        c.execute("CREATE TABLE users (name text, password text, admin integer, picture text);")
        c.execute("""INSERT INTO users VALUES ('hubert423', 'nFTHEHhMM2RNacEp', 1, 'https://snworksceo.imgix.net/dtc/3f037af6-87ce-4a37-bb37-55b48029727d.sized-1000x1000.jpg')""")
        c.execute("""INSERT INTO users VALUES ('MrNeglectedAdmin', 'wrhnrtnye4563', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEK5ST6yEIb8yQYeFWCVb6XnbpODs_BBscuA&usqp=CAU')""")
        c.execute("""INSERT INTO users VALUES ('UnhelpfulIndividual', 'sdgsdgfsdfg', 1, 'http://clipart-library.com/images/zcX5yqAgi.jpg')""")

        #c.execute("CREATE TABLE posts (content text, datestring text, username text);")
        #c.execute("""INSERT INTO posts VALUES ("This is a test", '2021-10-01', 'MrNeglectedAdmin')""")
        #c.execute("""INSERT INTO posts VALUES ("This is another test", '2021-10-01', 'UnhelpfulIndividual')""")

        conn.commit()
        conn.close()
