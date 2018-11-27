(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
    typeof define === 'function' && define.amd ? define(['exports'], factory) :
    (factory((global.jonggrang = global.jonggrang || {})));
}(this, function (exports) {
    'use strict';
     "use strict";
    /**
     *  A function that passed to first parameter of ChainRecFn
     */
    function nextRec(value) {
        return {
            done: false,
            value: value
        };
    }
    /**
     * A function that passed to second parameter of ChainRecFn
     */
    function doneRec(value) {
        return {
            done: true,
            value: value
        };
    }
    /**
     * A ChainRecFn that used to implements Task.do.
     *
     */
    function generatorStep(n, d, last) {
        var next = last.next;
        var _a = next(last.value), done = _a.done, value = _a.value;
        return done
            ? value.map(d)
            : value.map(function (x) { return n({ value: x, next: next }); });
    }
    var noop = function () { };
    var call = function (f) { return f(); };
    /**
     * Task represent values that depend on time similar to Promise. But Task are lazy
     * and monadic by design, the value will not there until you ask it, by calling .fork method.
     */
    var Task = (function () {
        function Task(computation) {
            this._computation = computation;
        }
        /**
        * Map a successfull value of task using an unary function.
        */
        Task.prototype.map = function (func) {
            var _this = this;
            return new Task(function (error, success) {
                return _this.fork(error, function (v) { return success(func(v)); });
            });
        };
        /**
         * Put a value as successful computation.
         */
        Task.of = function (value) {
            return new Task(function (_, success) {
                success(value);
                return noop;
            });
        };
        /**
         * Put a value as successful computation.
         */
        Task.prototype.of = function (value) {
            return Task.of(value);
        };
        /**
         * Apply a success value inside this task on other Task that have function as it
         * success value.
         * ap :: Task<a, b> -> Task<a, b -> s> -> Task<a, s>
         */
        Task.prototype.ap = function (other) {
            var _this = this;
            return new Task(function (error, success) {
                var func;
                var val;
                var otherOk;
                var thisOk;
                var ko;
                var guardReject = function (x) { return ko || (ko = 1, error(x)); };
                var cancel = _this.fork(guardReject, function (v) {
                    if (!otherOk)
                        return void (thisOk = 1, val = v);
                    return success(func(v));
                });
                var cancel1 = other.fork(guardReject, function (f) {
                    if (!thisOk)
                        return void (otherOk = 1, func = f);
                    return success(f(val));
                });
                return function () {
                    cancel();
                    cancel1();
                };
            });
        };
        /**
         * Combine this task with the given task, the result task when run, will fork
         * these task in parallel. If one of these task fail, the result task will fail.
         * The result is always an array, the first item is successfull value for own,
         * and the second one is from the given task.
         */
        Task.prototype.and = function (other) {
            var _this = this;
            return new Task(function (error, success) {
                var thisVal;
                var otherVal;
                var thisOk;
                var otherOk;
                var ko;
                var guardReject = function (x) { return ko || (ko = 1, error(x)); };
                var canceller = _this.fork(guardReject, function (v) {
                    if (!otherOk)
                        return void (thisOk = 1, thisVal = v);
                    return success([v, otherVal]);
                });
                var canceller1 = other.fork(guardReject, function (v1) {
                    if (!thisOk)
                        return void (otherOk = 1, otherVal = v1);
                    return success([thisVal, v1]);
                });
                return function () {
                    canceller();
                    canceller1();
                };
            });
        };
        /**
         * Similiar to map. But it accept a function that take one argument and return a Task,
         * the function will be called with successful value of this task then the returned
         * Task will be forked for successful value of the returned Task.
         */
        Task.prototype.chain = function (func) {
            var _this = this;
            return new Task(function (error, success) {
                var cancel = undefined;
                var selfCancel = _this.fork(error, function (v) {
                    var task = func(v);
                    cancel = task.fork(error, success);
                });
                return cancel ? cancel : (cancel = selfCancel, function () { return cancel(); });
            });
        };
        /**
         * like chain but the function passed here take 3 arguments: next, done, value
         * next and done is function and value is the previous results of task
         * examples: Task.chainRec((next, done, v) => v < 0 ? Task.of(done(v)) : Task.of(next(v - 1)), 5)
         */
        Task.chainRec = function (func, initial) {
            return new Task(function (error, success) {
                return (function step(acc) {
                    var status;
                    var elem = nextRec(acc);
                    var canceller = noop;
                    function onSuccess(v) {
                        if (status === 0) {
                            status = 1;
                            elem = v;
                        }
                        else {
                            var handler = v.done ? success : step;
                            handler(v.value);
                        }
                    }
                    while (!elem.done) {
                        status = 0;
                        canceller = func(nextRec, doneRec, elem.value).fork(error, onSuccess);
                        if (status === 1) {
                            if (elem.done) {
                                success(elem.value);
                            }
                            else {
                                continue;
                            }
                        }
                        else {
                            status = 2;
                            return canceller;
                        }
                    }
                    return canceller;
                })(initial);
            });
        };
        Task.do = function (func) {
            return new Task(function (error, success) {
                var gen = func();
                var next = function (x) { return gen.next(x); };
                var task = Task.chainRec(generatorStep, { value: undefined, next: next });
                return task.fork(error, success);
            });
        };
        /**
         * Run the given array of Task on parallel. If one of task fail, the result task
         * will also fail. The success value is an array of the successful value of each task
         * on then array, they appear on the same order as you passed here.
         */
        Task.parallel = function (arr) {
            return arr.length < 1
                ? Task.of([])
                : new Task(function (error, success) {
                    var len = arr.length;
                    var results = new Array(len);
                    var resolved = false;
                    var onError = function (e) { return resolved || (resolved = true, error(e)); };
                    function fork(item, i) {
                        return item.fork(onError, function (v) {
                            if (resolved)
                                return;
                            results[i] = v;
                            len = len - 1;
                            if (len === 0) {
                                success(results);
                                resolved = true;
                            }
                        });
                    }
                    var cancellers = arr.map(fork);
                    return function () {
                        cancellers.forEach(call);
                    };
                });
        };
        /**
         * Race a give array of Task, choose the earlier Task that settled it result.
         */
        Task.race = function (arr) {
            return new Task(function (error, success) {
                var settled = false;
                var guardReject = function (v) {
                    if (settled)
                        return;
                    error(v);
                    settled = true;
                };
                var guardResolve = function (v) {
                    if (settled)
                        return;
                    success(v);
                    settled = true;
                };
                var cancellers = arr.map(function (t) { return t.fork(guardReject, guardResolve); });
                return function () {
                    cancellers.forEach(call);
                };
            });
        };
        /**
         * Maps both sides of the disjunction.
         */
        Task.prototype.bimap = function (left, right) {
            var _this = this;
            return new Task(function (error, success) {
                return _this.fork(function (e) {
                    error(left(e));
                }, function (s) {
                    success(right(s));
                });
            });
        };
        /**
         * Takes two functions, applies the leftmost one to the failure value, and the
         * rightmost one to the successful value, depending on which one is present.
         */
        Task.prototype.fold = function (f, g) {
            var _this = this;
            return new Task(function (_, success) {
                return _this.fork(function (err) {
                    success(f(err));
                }, function (value) {
                    success(g(value));
                });
            });
        };
        /**
         * Swaps the disjunction values.
         */
        Task.prototype.swap = function () {
            var _this = this;
            return new Task(function (error, success) {
                return _this.fork(success, error);
            });
        };
        /**
         * Transforms a failure value into a new Task, Does nothing if the structure
         * already contains a successful value.
         */
        Task.prototype.orElse = function (func) {
            var _this = this;
            return new Task(function (error, success) {
                var canceller = undefined;
                var selfCancel = _this.fork(function (e) {
                    canceller = func(e).fork(error, success);
                }, success);
                return canceller ? canceller : (canceller = selfCancel, function () { return canceller(); });
            });
        };
        /**
         * Create new Task with results the provided value as it failure computation.
         */
        Task.rejected = function (er) {
            return new Task(function (error) {
                error(er);
                return noop;
            });
        };
        /**
         * sinonim for static rejected.
         */
        Task.prototype.rejected = function (er) {
            return Task.rejected(er);
        };
        /**
         * Like .map, but this method map the left side of the disjunction (failure).
         * @summary Task a b -> (a -> c) -> Task c b
         */
        Task.prototype.rejectedMap = function (func) {
            var _this = this;
            return new Task(function (error, success) {
                return _this.fork(function (e) { return error(func(e)); }, success);
            });
        };
        Task.prototype.fork = function (error, success) {
            var open = true;
            var canceller = this._computation(function (err) {
                if (open) {
                    open = false;
                    error(err);
                }
            }, function (val) {
                if (open) {
                    open = false;
                    success(val);
                }
            });
            return function () {
                canceller();
                canceller = noop;
            };
        };
        return Task;
    }());
    /**
     * Ideally this should be on class declaration, but unfortunately i dont know how
     * to do that on TS. It look like it doesn't support. So, i choose to patch the
     * Fantasy Land method here.
     */
    function patchFantasyLandMethod(constructor) {
        // Functor
        constructor.prototype['fantasy-land/map'] = constructor.prototype.map;
        // Chain
        constructor.prototype['fantasy-land/chain'] = constructor.prototype.chain;
        // applicative
        constructor.prototype['fantasy-land/of'] = constructor['fantasy-land/of'] = constructor.of;
        constructor.prototype['fantasy-land/ap'] = constructor.prototype.ap;
        // chainRec
        constructor.prototype['fantasy-land/chainRec'] = constructor['fantasy-land/chainRec'] = constructor.chainRec;
        // bimap
        constructor.prototype['fantasy-land/bimap'] = constructor.prototype.bimap;
    }
    patchFantasyLandMethod(Task);

    exports.Task = Task
}))